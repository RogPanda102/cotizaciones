let departamentoDetectado = null;

function pedidoForm() {

    return {

        tipo: window.pedidoOld?.tipo ?? '',
        departamentoId: window.pedidoOld?.departamentoId ?? '',
        analistaId: window.pedidoOld?.analistaId ?? ''

    };

}

function cerrarModalDepartamento() 
{
    const modalEl = document.getElementById('modalDepartamento');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) {
        modal.hide();
    }

}

function cerrarModalAnalista() 
{
    const modalEl = document.getElementById('modalAnalista');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal)
    {
        modal.hide();
    }
}


function guardarAnalista() {

    const payload = {

        nombre: (document.getElementById('nuevo_analista_nombre').value || '').trim(),

        apellido_paterno: (document.getElementById('nuevo_analista_apellido_paterno').value || '').trim(),

        apellido_materno: (document.getElementById('nuevo_analista_apellido_materno').value || '').trim(),

        telefono: (document.getElementById('nuevo_analista_telefono').value || '').trim(),

        email: (document.getElementById('nuevo_analista_email').value || '').trim().toLowerCase(),

    };

    if (!payload.nombre || !payload.apellido_paterno) {

        alert('Nombre y apellido paterno son obligatorios');

        return;
    }

    fetch(window.appData.routes.analistasStore, {

        method: 'POST',

        headers: {

            'Content-Type': 'application/json',

            'Accept': 'application/json',

            'X-CSRF-TOKEN': window.appData.csrfToken,

        },

        body: JSON.stringify(payload),

    })

    .then(async res => {

        const data = await res.json();

        if (!res.ok) {
            throw new Error(data.message || 'Error al guardar analista');
        }

        return data;

    })

    .then(analista => {

        const select = document.getElementById('analistaSelect');

        const option = document.createElement('option');

        option.value = analista.id;

        option.text = analista.nombre;

        select.appendChild(option);

        select.value = analista.id;

        cerrarModalAnalista();

    })

    .catch(error => {

        console.error(error);

        alert('Ocurrió un error al guardar el analista');

    });

}

function guardarDepartamento() {

    if (departamentoDetectado) {

        alert('Este departamento ya existe, usa "Usar este departamento"');

        return;
    }

    const payload = {

        nombre_departamento: document.getElementById('nuevo_departamento').value.trim(),

        responsable: document.getElementById('nuevo_contacto').value.trim(),

        telefono: (document.getElementById('nuevo_telefono').value || '').replace(/\D/g, ''),

        email: (document.getElementById('nuevo_email').value || '').trim().toLowerCase(),

        direccion: document.getElementById('nuevo_direccion').value.trim(),

    };

    if (!payload.nombre_departamento) {

        alert('El nombre del departamento es obligatorio');

        return;
    }

    fetch(window.appData.routes.departamentosStore, {

        method: 'POST',

        headers: {

            'Content-Type': 'application/json',

            'Accept': 'application/json',

            'X-CSRF-TOKEN': window.appData.csrfToken,

        },

        body: JSON.stringify(payload),

    })

    .then(res => {

        if (!res.ok) {
            throw new Error('Error al guardar departamento');
        }

        return res.json();

    })

    .then(departamento => {

        const select = document.getElementById('departamentoSelect');

        let option = document.createElement('option');

        option.value = departamento.id;

        option.text = departamento.nombre;

        select.appendChild(option);

        select.value = departamento.id;

        departamentoDetectado = null;

        document.getElementById('departamento-existente').classList.add('d-none');

        cerrarModalDepartamento();

    })

    .catch(error => {

        console.error(error);

        alert('Ocurrió un error al guardar el departamento');

    });

}

// 🔥 BUSCAR DEPARTAMENTO EXISTENTE
function buscarDepartamentoExistente() {

    const email = (document.getElementById('nuevo_email').value || '')
        .trim()
        .toLowerCase();

    const telefono = (document.getElementById('nuevo_telefono').value || '')
        .replace(/\D/g, '');

    if (!email && !telefono) return;

    fetch(
        `${window.appData.routes.departamentosBuscar}?email=${encodeURIComponent(email)}&telefono=${encodeURIComponent(telefono)}`
    )

    .then(res => res.json())

    .then(departamento => {

        if (departamento && departamento.id) {

            departamentoDetectado = departamento;

            document.getElementById('departamento-existente')
                .classList.remove('d-none');

            document.getElementById('departamento-info').innerText =
                `${departamento.nombre_departamento ?? 'Sin departamento'} - ${departamento.responsable ?? 'Sin responsable'}`;

        } else {

            departamentoDetectado = null;

            document.getElementById('departamento-existente')
                .classList.add('d-none');

        }

    });

}
// 🔥 USAR DEPARTAMENTO DETECTADO
function usarClienteExistente() {
    if (!departamentoDetectado) return;

    let select = document.getElementById('departamentoSelect');

    select.value = departamentoDetectado.id;

    cerrarModalDepartamento();
}

// 🔥 ACTIVAR DETECCIÓN AUTOMÁTICA
document.addEventListener('DOMContentLoaded', () => {

    const email = document.getElementById('nuevo_email');

    const telefono = document.getElementById('nuevo_telefono');

    if (email) {
        email.addEventListener('blur', buscarDepartamentoExistente);
    }

    if (telefono) {
        telefono.addEventListener('blur', buscarDepartamentoExistente);
    }

});