import React from "react";
import ButtonText from "assets/button_text/ButtonText.jsx";

function FormCustom(
    {
        className,
        titre,
        inputs,
        buttonText,
    }
) {
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
    alert(
        inputs.map((input) => {
            return (`${input.name} : ${state[input.name]}`)
        }).join("\n")
    );

        for (const key in state) {
            setState({
                ...state,
                [key]: ""
            });
        }
    };

    return (
        <div
            className={`form-container ${className || ""}`}
        >
            <form
                onSubmit={handleOnSubmit}
            >
                <h1>{titre}</h1>
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
                    text={buttonText}
                    id={`${titre}_${buttonText}`}
                />

            </form>
        </div>
    )
}

export default FormCustom