import React from "react";
import axiosConfig from "src/utils/axios/axiosConfig.js";
import ButtonText from "assets/button_text/ButtonText.jsx";
import axios from "axios";
import {toast} from "react-toastify";
function SignUp(
    {
        className,
    }
) {

    let formDefinition = {
        key:"SignUp",
        className:"",
        titre:"Créer un compte",
        buttonText:"Créer son compte",
    }
    let inputs = [
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
            name:"password",
        }
    ]

    const initialState = inputs.reduce((acc, input) => {
        acc[input.name] = "";
        return acc;
    }, {});

    const [state, setState] = React.useState(initialState);

    const handleChange = evt => {
        const value = evt.target.value;
        setState({
            ...state,
            [evt.target.name]: value
        });
    };
    const handleOnSubmit = evt => {
        evt.preventDefault();
        let data = {}
        inputs.forEach((input) => {
            data[input.name] = state[input.name];
        });

        axiosConfig.post(
            '/utilisateur',
            data)
            .then(
                () => toast.success('Nouvel utilisateur créé !')
            )
            .catch(
                () => toast.error('Un problème est survenu durant la création.')
            )
        for (const key in state) {
            setState({
                ...state,
                [key]: ""
            });
        }
    }


    return (
            <div
                className={`form-container ${className || ""}`}
            >
                <form
                    onSubmit={handleOnSubmit}
                >
                    <h1>{formDefinition.titre}</h1>
                    {inputs.map((input, index) => {
                        return (
                            <input
                                key={index}
                                type={input.type}
                                placeholder={input.placeholder}
                                name={input.name}
                                value={state[input.name]}
                                onChange={handleChange}
                            />
                        )
                    })}
                    <ButtonText
                        text={formDefinition.buttonText}
                        id={`${formDefinition.titre}_${formDefinition.buttonText}`}
                    />

                </form>
            </div>
    )
}

export default SignUp;
