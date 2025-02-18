import React from 'react';
import { CgProfile } from "react-icons/cg";
import { CiBoxList } from "react-icons/ci";
import { MdLogout } from "react-icons/md";
import './Navbar.css';

const Navbar = () => {
    return (
        <div className='navbar'>
            <ul>
                <li className="navbar-section">
                    <i><CgProfile/></i>
                    <span>Profil</span>
                </li>
                <li className="separator"/>
                <li className="navbar-section">
                    <i><CiBoxList/></i>
                    <span>Planning</span>
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

export default Navbar;