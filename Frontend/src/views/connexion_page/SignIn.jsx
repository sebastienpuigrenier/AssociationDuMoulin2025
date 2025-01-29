import React from "react";
import FormCustom from "assets/form/FormCustom.jsx";

function SignInForm(
    {
        className,
    }
) {
    return (
            <FormCustom
                key="SignIn"
                className={className}
                titre="Se connecter"
                inputs ={[
                    {
                        name:"email",
                        type:"email",
                        placeholder:"Email",
                    },
                    {
                        name:"Mot de passe",
                        type:"password",
                        placeholder:"Mot de passe",
                    }
                ]}
                buttonText="Connexion"
            />
    );
}

export default SignInForm;
