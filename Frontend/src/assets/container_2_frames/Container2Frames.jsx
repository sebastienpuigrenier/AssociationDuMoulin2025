import React, {useState} from "react";
import ButtonText from "assets/button_text/ButtonText.jsx";
function Container2Frames (
    {
        frames,
        overlay,
    }
) {
    const [type, setType] = useState("frame1Activated");
    const handleOnClick = text => {
        if (text !== type) {
            setType(text);
        }
    };
    const containerClass =
        "container_2_frames " + (type === "leftFrameActivated" ? "right-panel-active" : "");

    return (
        <div className={containerClass} id="container_2_frames">
            {frames.map((frame, index) => (
                <div key={index}>{frame.asset}</div>
            ))}
            <div className="overlay-container">
                <div className="overlay">
                    <div className="overlay-panel overlay-left">
                        <h1>{overlay[0].titre}</h1>
                        <p>
                            {overlay[0].texte}
                        </p>
                        <ButtonText
                            text={overlay[0].boutonTitre}
                            className="ghost"
                            id={overlay[0].boutonTitre}
                            onClick={() => handleOnClick("frame1Activated")}
                        />
                    </div>
                    <div className="overlay-panel overlay-right">
                        <h1>{overlay[1].titre}</h1>
                        <p>{overlay[0].texte}</p>
                        <ButtonText
                            text={overlay[0].boutonTitre}
                            className="ghost "
                            id={overlay[0].boutonTitre}
                            onClick={() => handleOnClick("leftFrameActivated")}
                        />
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Container2Frames