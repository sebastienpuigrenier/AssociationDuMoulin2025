import React, {useEffect, useState} from 'react'
import {isAdminAuth, isLogInAuth} from "src/utils/authentification/JWTManagement.jsx";
import ButtonText from "assets/button_text/ButtonText.jsx";
import Navbar from "views/back-office_page/navbar/navbar.jsx";
import AdminNavbar from "views/back-office_page/navbar/adminNavbar.jsx";
function BackOfficePage() {
    const [isLogIn, setIsLogIn] = useState(false)
    const [isAdmin, setIsAdmin] = useState(false)

    useEffect(() => {
        setIsLogIn(isLogInAuth)
        setIsAdmin(isAdminAuth)
    }, []);

    if (isLogIn === false) {
        return (
            <div>
                <p>
                    Vous n'avez pas les droits pour accéder à cette page !
                </p>
                <ButtonText
                    text = "Retour à la page principale"
                    className = ""
                    id = "retour"
                    onClick={() => window.location.href = '/'}
                />
            </div>
        )
    }

    return (
    <div className="boack-office">
      <header>
        <h1>Bienvenue dans le Back Office</h1>
      </header>
        {
            isAdmin ?  <AdminNavbar/> : <Navbar/>
        }
      <section className="description">
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </p>
        <p>
          Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
      </section>
    </div>
  )
}export default BackOfficePage