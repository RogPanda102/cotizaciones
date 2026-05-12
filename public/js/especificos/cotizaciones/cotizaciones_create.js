function cotizacionForm() {

    return {

        tipo: window.cotizacionData.old.tipo ?? '',
        estado: window.cotizacionData.old.estado ?? 'enviado',
        fechaEnvio: window.cotizacionData.old.fechaEnvio ?? '',
        dependenciaId: window.cotizacionData.old.dependenciaId ?? '',

        analistaId: window.cotizacionData.old.analistaId ?? '',

        departamentoId: window.cotizacionData.old.departamentoId ?? '',

        dependencias: window.cotizacionData.dependencias ?? [],

        analistas: window.cotizacionData.analistas ?? [],

        departamentos: window.cotizacionData.departamentos ?? [],

        departamentoDetectado: null,

        modal: {

            open: false,

            type: '',

            endpoint: '',

            title: '',

            form: {},

            saving: false,

            error: '',

        },

        getEmptyForm(type) {

            if (type === 'analista') {

                return {

                    nombre: '',

                    apellido_paterno: '',

                    apellido_materno: '',

                    email: '',

                    telefono: '',

                };

            }

            return {

                dependencia_id: this.dependenciaId
                    ? String(this.dependenciaId)
                    : '',

                nombre_departamento: '',

                responsable: '',

                telefono: '',

                email: '',

                direccion: '',

            };

        },

        openModal(type) {

            const config = {

                analista: {

                    endpoint: window.cotizacionData.routes.analistasStore,

                    title: 'Nuevo analista',

                },

                departamento: {

                    endpoint: window.cotizacionData.routes.departamentosStore,

                    title: 'Nuevo departamento',

                },

            };

            if (!config[type]) {
                return;
            }

            this.modal.type = type;

            this.modal.endpoint = config[type].endpoint;

            this.modal.title = config[type].title;

            this.modal.form = this.getEmptyForm(type);

            this.modal.error = '';

            this.departamentoDetectado = null;

            this.modal.open = true;

        },

        closeModal() {

            this.modal.open = false;

            this.modal.type = '';

            this.modal.endpoint = '';

            this.modal.title = '';

            this.modal.form = {};

            this.modal.saving = false;

            this.modal.error = '';

            this.departamentoDetectado = null;

        },

        normalizarTelefono(value) {

            return (value || '').replace(/\D/g, '');

        },

        async buscarDepartamentoExistente() {

            if (this.modal.type !== 'departamento') {
                return;
            }

            const email = (this.modal.form.email || '')
                .trim()
                .toLowerCase();

            const telefono = this.normalizarTelefono(
                this.modal.form.telefono
            );

            if (!email && !telefono) {

                this.departamentoDetectado = null;

                return;

            }

            try {

                const query = new URLSearchParams({
                    email,
                    telefono
                });

                const response = await fetch(
                    `${window.cotizacionData.routes.departamentosBuscar}?${query.toString()}`,
                    {
                        headers: {
                            'Accept': 'application/json'
                        },
                    }
                );

                if (!response.ok) {

                    this.departamentoDetectado = null;

                    return;

                }

                const departamento = await response.json();

                this.departamentoDetectado =
                    departamento && departamento.id
                        ? departamento
                        : null;

            } catch (error) {

                console.error(error);

                this.departamentoDetectado = null;

            }

        },

        usarDepartamentoExistente() {

            if (!this.departamentoDetectado) {
                return;
            }

            if (
                !this.departamentos.some(
                    dep =>
                        String(dep.id) ===
                        String(this.departamentoDetectado.id)
                )
            ) {
                this.departamentos.push({
                    id: this.departamentoDetectado.id,
                    responsable: this.departamentoDetectado.responsable,
                });
            }
            this.departamentoId = String(
                this.departamentoDetectado.id
            );
            this.closeModal();
        },
        async saveModalItem() {
            const payload = { ...this.modal.form };
            if (this.modal.saving || !this.modal.endpoint) {
                return;
            }
            if (this.modal.type === 'analista') {
                payload.nombre =
                    (payload.nombre || '').trim();
                payload.apellido_paterno =
                    (payload.apellido_paterno || '').trim();
                payload.apellido_materno =
                    (payload.apellido_materno || '').trim();
                payload.email =
                    (payload.email || '').trim();
                payload.telefono =
                    (payload.telefono || '').trim();
                if (!payload.nombre || !payload.apellido_paterno) {
                    this.modal.error =
                        'Nombre y apellido paterno son obligatorios.';
                    return;
                }
            }
            if (this.modal.type === 'departamento') {
                payload.nombre_departamento =
                    (payload.nombre_departamento || '').trim();
                payload.responsable =
                    (payload.responsable || '').trim();
                payload.telefono =
                    this.normalizarTelefono(payload.telefono);
                payload.email =
                    (payload.email || '')
                        .trim()
                        .toLowerCase();
                payload.direccion =
                    (payload.direccion || '').trim();
                payload.dependencia_id =
                    payload.dependencia_id || null;
                if (!payload.nombre_departamento) {
                    this.modal.error =
                        'El nombre del departamento es obligatorio.';
                    return;
                }
                await this.buscarDepartamentoExistente();
                if (this.departamentoDetectado) {
                    this.modal.error =
                        'Ya existe un departamento con ese email o teléfono. Puedes usarlo directamente.';
                    return;
                }
            }
            this.modal.saving = true;
            this.modal.error = '';
            try {
                const response = await fetch(
                    this.modal.endpoint,
                    {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN':
                                window.cotizacionData.csrfToken,
                        },
                        body: JSON.stringify(payload),
                    }
                );
                const data = await response.json();
                if (!response.ok) {
                    this.modal.error =
                        data.message || 'No se pudo guardar.';
                    console.error(
                        'Error creando registro:',
                        data
                    );
                    alert('No se pudo guardar el registro.');
                    return;
                }
                if (this.modal.type === 'analista') {
                    this.analistas.push(data);
                    this.analistaId = String(data.id);
                } else if (this.modal.type === 'departamento') {
                    this.departamentos.push(data);
                    this.departamentoId = String(data.id);
                }
                this.closeModal();
            } catch (error) {
                console.error(error);
                this.modal.error =
                    'Error de red al guardar.';
                alert('Ocurrió un error de red al guardar.');
            } finally {
                this.modal.saving = false;
            }
        },
    };
}