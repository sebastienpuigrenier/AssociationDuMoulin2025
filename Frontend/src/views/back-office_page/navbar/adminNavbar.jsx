import React from 'react';
import { CgProfile } from "react-icons/cg";
import { MdLogout, MdChildCare } from "react-icons/md";
import './Navbar.css';

const AdminNavbar = () => {
    return (
        <div className='navbar'>
            <ul>
                <li className="navbar-section">
                    <i><CgProfile/></i>
                    <span>Profil</span>
                </li>
                <li className="separator"/>
                <li className="navbar-section">
                    <i><MdChildCare/></i>
                    <span>Enfants</span>
                </li>
                <li className="separator"/>
                <li className="navbar-section">
                    <i><MdLogout/></i>
                    <span>Sortir</span>
                </li>
            </ul>
        </div>
);
};

export default AdminNavbar;