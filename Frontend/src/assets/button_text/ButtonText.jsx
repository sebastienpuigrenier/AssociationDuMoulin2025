import React from "react";

function ButtonText(
    {
        text,
        className,
        id,
        onClick
    }
) {
    return(
        <button
            className={className || ""}
            id={id || ""}
            onClick={onClick || (() => {})}
        >
            {text}
        </button>
    )
}

export default ButtonText