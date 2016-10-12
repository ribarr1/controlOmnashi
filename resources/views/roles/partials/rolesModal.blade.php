<!-- Modal -->
@section('renderFormulario')
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar Roles de Usuarios</h4>
            </div>
            <div class="modal-body">
                
                @include('roles.partials.frmRoles')

            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary btn-flat btn-guardar">
                  {{ trans('adminlte_lang::message.save')  }} <i class="fa fa-save" aria-hidden="true"></i> 
                </a>
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
                  {{ trans('adminlte_lang::message.close')  }} <span aria-hidden="true">&times;</span>
                </button>

            </div>
        </div>
    </div>
</div>
@show