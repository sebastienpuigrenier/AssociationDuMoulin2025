import React from "react";
import FormCustom from "assets/form/FormCustom.jsx";
function SignUp(
    {
        className,
    }
) {
    return (
        <FormCustom
            key="SignUp"
            className={className}
            titre="Créer un compte"
            inputs ={[
                {
                    name:"nom",
                    type:"text",
                    placeholder:"Nom",
                },
                {
                    name:"prenom",
                    type:"text",
                    placeholder:"Prénom",
                },
                {
                    name:"email",
                    type:"email",
                    placeholder:"Email",
                },
                {
                    type:"password",
                    placeholder:"Mot de passe",
                    name:"Mot de passe",
                }
            ]}
            buttonText="Créer son compte"
        />
    );
}

export default SignUp;
