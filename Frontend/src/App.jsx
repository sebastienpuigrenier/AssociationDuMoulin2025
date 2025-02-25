import './reset.css'
import './App.css'
import 'assets/toastify/Toastify.css'
import LandingPage from "views/landing_page/landing_page.jsx";
import {BrowserRouter, Route, Routes} from "react-router-dom";
import ConnexionPage from "views/connexion_page/Connexion.jsx";
import {ToastContainer} from "react-toastify";
import BackOfficePage from "views/back-office_page/back-office.jsx";

function App() {
  return (
      <>
          <BrowserRouter>
              <Routes>
                  <Route path="/" element={<LandingPage />}/>
                  <Route path="/connexion" element={<ConnexionPage />}/>
                  <Route path="/back-office">
                      <Route path="*" element={<BackOfficePage />}/>
                  </Route>
                  {/*<Route path="*" element={<Page404 />} />*/}
              </Routes>
          </BrowserRouter>
          <ToastContainer />
      </>
  )
}

export default App
