<div class="modal fade" tabindex="-1" id="subscriptionModal" role="dialog" aria-labelledby="Ecran d'inscription">
    <div class="modal-dialog modal-sm">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal-title-inscription">Inscription</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group has-feedback">
                        <label for="mailForm">Adresse email : </label>
                        <input style="margin-bottom:1%;" id="mailForm" type="email" class="form-control" placeholder="terminator@gmail.com">
                        <i class="glyphicon form-control-feedback" id="iconMail"></i>
                        <span class="libelleError" id="libelleMail" style="color:#ff4d4d;"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="loginForm">Login : </label>
                        <input style="margin-bottom:1%;" id="loginForm" type="text" class="form-control" placeholder="napalm51">
                        <i class="glyphicon form-control-feedback" id="iconLogin"></i>
                        <span class="libelleError" id="libelleLogin" style="color:#ff4d4d;"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="mdpForm">Mot de passe : </label>
                        <input style="margin-bottom:1%;"id="mdpForm" type="password" class="form-control">
                        <i class="glyphicon form-control-feedback" id="iconMdp1"></i>
                        <span class="libelleError" id="libelleMdp1" style="color:#ff4d4d;"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="mdpValidationForm">Valider le mot de passe : </label>
                        <input style="margin-bottom:1%;" id="mdpValidationForm" type="password" class="form-control">
                        <i class="glyphicon form-control-feedback" id="iconMdp2"></i>
                        <span class="libelleError" id="libelleMdp2" style="color:#ff4d4d;"></span>
                    </div>
                    <ul id="labelMdpWrong"></ul>
                </form>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="register_create" class="btnInscription btn btn-lg btn-warning"> S'inscrire</button>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" tabindex="-1" id="signUpModal" role="dialog" aria-labelledby="Ecran d'authentification">
    <div class="modal-dialog modal-sm">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal-title-inscription">Connexion</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="loginAuth">Login : </label>
                        <input id="loginAuth" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="mdpAuth">Mot de passe : </label>
                        <input id="mdpAuth" type="password" class="form-control"></td>
                        <span style="margin-top:1%;border:0px;background-color:transparent;"class="input-group-addon">
                            <i class="glyphicon glyphicon-eye-close"></i>
                        </span>
                    </div>
                    <span id="labelAuthWrong"></span>
                </form>
                                       
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="authentifier" class="btnInscription btn btn-lg btn-warning">Se connecter</button>
                </div>
            </div>
        </div>
    </div>
</div>