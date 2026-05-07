<?php

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