<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog mar-top-2rem">
        <!-- Modal content-->
        <div class="modal-content">
            <div id="lineNumber" style="display: none;"></div>
            <div class="modal-header">
                <button type="button" class="close" onclick="reset_form()" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Uredi</h4>
            </div>
            <form id="modal_form">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Ime</label>
                            <div class="form-group">
                                <input type="text" name="modal_firstname" id="modal_firstname" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Priimek</label>
                            <div class="form-group">
                                <input type="text" name="modal_lastname" id="modal_lastname" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="form-group">
                                <input type="email" name="modal_email" id="modal_email" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Aktiviran</label>
                            <div class="form-group">
                                <input type="checkbox" name="modal_togglebtn" checked="false" data-toggle="toggle" data-size="small" id="modal_togglebtn">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Novo geslo</label>
                            <div class="form-group">
                                <input type="password" name="modal_password_1" id="modal_password_1" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">Potrdi geslo</label>
                            <div class="form-group">
                                <input type="password" name="modal_password_2" id="modal_password_2" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="errors" class="alert alert-danger mar-top-1rem" style="visibility: hidden;">
                    </div>
                    <button type="submit" name="modal_form" onclick="save_edit()" class="btn btn-default">Shrani</button>
                </div>
            </form>
        </div>
    </div>
</div>