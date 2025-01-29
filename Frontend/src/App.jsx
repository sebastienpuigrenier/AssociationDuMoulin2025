import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './reset.css'
import './App.css'
import LandingPage from "views/landing_page/landing_page.jsx";
import {BrowserRouter, Route, Routes} from "react-router-dom";
import ConnexionPage from "views/connexion_page/Connexion.jsx";

function App() {
  const [count, setCount] = useState(0)

  return (
      <BrowserRouter>
          <Routes>
              <Route path="/" element={<LandingPage />}/>
              <Route path="/connexion" element={<ConnexionPage />}/>
              {/*<Route path="*" element={<Page404 />} />*/}
          </Routes>
      </BrowserRouter>

  )
}

export default App
