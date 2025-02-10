import React from "react";
import ButtonText from "assets/button_text/ButtonText.jsx";
import axios from "axios";
import axiosConfig from "src/utils/axios/axiosConfig.js";
import {toast} from "react-toastify";

function SignInForm(
    {
        className,
    }
) {

    let formDefinition = {
        key:"SignUp",
        className:"",
        titre:"connexion",
        buttonText:"Se connecter",
    }

    let inputs =[
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
        let data = {
            "username": state[inputs[0].name],
            "password": state[inputs[1].name],
        }
        axiosConfig.post(
            '/login',
            data)
            .then(
                (response) => {
                    localStorage.setItem('associationDuMoulinToken', response.data.token)
                    toast.success('L\'identification a réussi !')
                }
            )
            .catch(
                () => toast.error('Un problème est survenu durant l\'identification.')
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

export default SignInForm;
