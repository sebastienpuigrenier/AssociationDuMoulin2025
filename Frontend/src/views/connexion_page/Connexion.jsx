import React, { useState } from "react";
import SignInForm from "./SignIn";
import SignUpForm from "./SignUp";
import Container2Frames from "assets/container_2_frames/Container2Frames.jsx";
import ButtonText from "assets/button_text/ButtonText.jsx";

export default function ConnexionPage() {
    return (
        <div className="connexion-page">
            <Container2Frames
                frames = {[
                    {asset : <SignInForm className = 'left-frame'/>},
                    {asset : <SignUpForm className = 'right-frame' />},
                ]}
                overlay = {[
                    {
                        titre : "Content de vous revoir !",
                        texte : "Pour avoir accès à vos informations, merci de vous connecter",
                        boutonTitre : "Se connecter",
                    },
                    {
                        titre : "Bienvenue !",
                        texte : "Pour nous rejoindre, remplissez les informations.",
                        boutonTitre : "Créer un compte",
                    }
                ]}
            />
            <ButtonText
                text = "Retour à la page principale"
            className = ""
            id = "retour"
                onClick={() => window.location.href = '/'}
                />
        </div>
    );
}
