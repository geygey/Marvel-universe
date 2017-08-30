<!--Modal pour l'inscription-->
<div class="modal fade" tabindex="-1" id="subscriptionModal" role="dialog" aria-labelledby="Ecran d'inscription">
    <div class="modal-dialog modal-sm">
    <!-- Modal content-->
        <div class="modal-content">
            <!--Inscription-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal-title-inscription">Inscription</h4>
            </div>
            <!--Formulaire-->
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
                        <span style="margin-top:1%;border:0px;background-color:transparent;"class="form-control input-group-addon">
                            <i class="glyphicon glyphicon-eye-close" data-id="mdpForm"></i>
                        </span>
                        <i class="glyphicon form-control-feedback" id="iconMdp1"></i>
                        <span class="libelleError" id="libelleMdp1" style="color:#ff4d4d;"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="mdpValidationForm">Valider le mot de passe : </label>
                        <input style="margin-bottom:1%;" id="mdpValidationForm" type="password" class="form-control">
                        <span style="margin-top:1%;border:0px;background-color:transparent;"class="form-control input-group-addon">
                            <i class="glyphicon glyphicon-eye-close" data-id="mdpValidationForm"></i>
                        </span>
                        <i class="glyphicon form-control-feedback" id="iconMdp2"></i>
                        <span class="libelleError" id="libelleMdp2" style="color:#ff4d4d;"></span>
                    </div>
                    <ul id="labelMdpWrong"></ul>
                </form>
            </div>
            <!--Bouton de confirmation-->
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="register_create" class="btnInscription btn btn-lg btn-warning"> S'inscrire</button>
                </div>
            </div>
        </div>

    </div>
</div>
<!--Modal pour l'authentification-->
<div class="modal fade" tabindex="-1" id="signUpModal" role="dialog" aria-labelledby="Ecran d'authentification">
    <div class="modal-dialog modal-sm">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal-title-inscription">Connexion</h4>
            </div>
            <!--Formulaire-->
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
                            <i class="glyphicon glyphicon-eye-close" data-id="mdpAuth"></i>
                        </span>
                    </div>
                    <span id="labelAuthWrong"></span>
                </form>
                                       
            </div>
            <!--Bouton de confirmation-->
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="authentifier" class="btnInscription btn btn-lg btn-warning">Se connecter</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Modal pour modifier son compte-->
<div class="modal fade" tabindex="-1" id="modifyModal" role="dialog" aria-labelledby="Modification du compte">
    <div class="modal-dialog modal-sm">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal-title-inscription">Gestion de votre compte</h4>
            </div>
            <!--Formulaire-->
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <div class="form-group has-feedback">
                            <label for="newMail">Nouvelle adresse email : </label>
                            <input style="margin-bottom:1%;" id="newMail" type="email" class="form-control" placeholder="terminator@gmail.com">
                            <i class="glyphicon form-control-feedback" id="iconNewMail"></i>
                            <span class="libelleError" id="libelleNewMail" style="color:#ff4d4d;"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="newMdp">Nouveau mot de passe : </label>
                            <input id="newMdp" type="password" class="form-control"></td>
                            <span style="margin-top:1%;border:0px;background-color:transparent;"class="form-control input-group-addon">
                                <i class="glyphicon glyphicon-eye-close" data-id="newMdp"></i>
                            </span>
                            <i class="glyphicon form-control-feedback" id="iconNewMdp1"></i>
                            <span class="libelleError" id="libelleNewMdp2" style="color:#ff4d4d;"></span>
                        <div>
                        <div class="form-group has-feedback">
                            <label for="renewMdp">Confirmez le nouveau mot de passe : </label>
                            <input id="renewMdp" type="password" class="form-control"></td>
                            <span style="margin-top:1%;border:0px;background-color:transparent;"class="form-control input-group-addon">
                                <i class="glyphicon glyphicon-eye-close" data-id="renewMdp"></i>
                            </span>
                            <i class="glyphicon form-control-feedback" id="iconNewMdp2"></i>
                            <span class="libelleError" id="libelleNewMdp2" style="color:#ff4d4d;"></span>
                        </div>
                     
                       
                        
                        
                    </div>
                    <span id="labelModifWrong"></span>
                </form>
                                       
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="submit" id="modifierCompte" class="btnInscription btn btn-lg btn-warning">Valider les modifications</button>
                </div>
            </div>
        </div>
    </div>
</div>