import React, { useState } from "react";
import "./styles.css";
import SignInForm from "./SignIn";
import SignUpForm from "./SignUp";
import Container2Frames from "assets/container_2_frames/Container2Frames.jsx";

export default function ConnexionPage() {
    return (
        <div>
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
        </div>
    );
}
