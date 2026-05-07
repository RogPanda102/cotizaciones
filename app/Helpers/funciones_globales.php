<?php
    use App\Enums\TipoAlerta;

    // =======================  
    // B R E A D   C R U M B
    // =======================
    function breadcrumb ($tarea = '', $breadcrumb = array())
    {
        // dd($breadcrumb);
        $html='';
        if (sizeof($breadcrumb)>0)
            {
            $html.= '
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">
                            '.$tarea.'
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="'.route('empresas.index').'">Inicio</a></li>';
                            foreach ($breadcrumb as $nav) {
                                if(isset($nav['href'])){
                                    if($nav["href"] != '#'){
                                        $html.= '<li class="breadcrumb-item active"><a href="'.$nav["href"].'">'.$nav["tarea"].'</a></li>';
                                    }//end nav
                                    else{
                                        $html.= '<li class="breadcrumb-item text-black">'.$nav["tarea"].'</li>';
                                    }//end else
                                }//end if isset
                            }//end foreach
                            $html.='</ol>
                        </ol>
                    </div>
                </div>
            ';
        } //END IF SIZEOF
        return $html;

    }

    function mensaje($texto = "",TipoAlerta $tipo = TipoAlerta::INFO,$tiempo = 1000)
    {
        $mensaje = array();
        $mensaje['texto'] = $texto;
        $mensaje['tipo'] = $tipo->value;
        $mensaje['tiempo'] = $tiempo;
        session()->flash('mensaje', $mensaje);

    }//end function

    function mostrar_mensaje()
    {
        $html = '';

        $mensaje = session('mensaje');

        // 🔥 Si no existe mensaje
        if (!$mensaje) {
            return "";
        }

        switch($mensaje['tipo']) {

            case TipoAlerta::SUCCESS->value:

                $tipoMensaje = "success";
                $titulo = "¡Correcto!";

            break;

            case TipoAlerta::DANGER->value:

                $tipoMensaje = "error";
                $titulo = "¡Error!";

            break;

            case TipoAlerta::WARNING->value:

                $tipoMensaje = "warning";
                $titulo = "¡Atención!";

            break;

            default:

                $tipoMensaje = "info";
                $titulo = "¡Bienvenido!";

            break;
        }
        session()->forget('mensaje');

        $html = '
            <script>

                toastr["'.$tipoMensaje.'"](
                    "'.$mensaje["texto"].'",
                    "'.$titulo.'",
                    {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "showDuration": "'.$mensaje["tiempo"].'",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                );

            </script>
        ';

        return $html;
    }