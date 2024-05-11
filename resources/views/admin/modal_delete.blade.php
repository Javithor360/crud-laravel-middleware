<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.delete') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" id="delete_id">
                <div class="text-center">
                    <h1>!</h1>
                </div>

                <div class="modal-body">
                    <center>
                        <h1>ADVERTENCIA</h1>
                        <h6>¿Estás seguro de que deseas eliminar a este usuario?</h6>
                    </center>
                </div>
                <div class="row" style="margin-bottom: 50px; text-align: center;">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-secondary btn-modal" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-danger btn-modal">Eliminar</button>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div>
    </div>
</div>
