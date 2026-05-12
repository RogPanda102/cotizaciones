function confirmDelete(id) 
{
    Swal.fire
    ({
        title: '¿Eliminar pedido?',
        text: "Esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    })
    .then((result) => 
    {
        if (result.isConfirmed) 
        {
            let form = document.getElementById('delete-form-' + id);
            if (form) 
            {
                form.submit();
            } 
            else 
            {
                console.error('Form no encontrado');
            }
        }
    });
}