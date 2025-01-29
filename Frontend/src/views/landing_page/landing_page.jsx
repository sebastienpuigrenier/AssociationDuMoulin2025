import React from 'react'
import ButtonText from "assets/button_text/ButtonText.jsx";
function LandingPage() {return (
    <div className="landing-page">
      <header>
        <h1>Bienvenue à la périscolaire de l'école du Moulin</h1>
      </header>
      <section className="description">
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </p>
        <p>
          Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
      </section>
      <ButtonText
          text="Connexion"
          className="register-button"
          onClick={() => window.location.href = '/connexion'}
      />
    </div>
  )
}export default LandingPage