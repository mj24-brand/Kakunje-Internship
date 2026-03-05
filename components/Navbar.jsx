import React from 'react'
import {Link} from 'react-router-dom'
import { useContext } from 'react'
import ThemeContext from '../context/ThemeContext'
import "../styles/Navbar.css"

const Navbar = () => {
    const {toggleTheme}=useContext(ThemeContext)

  return (
        <nav className='navbar'>
      <h2>  <i className="bi bi-fork-knife"></i>  MJ Cravings</h2>
      <div>
        <Link to="/Login">Login</Link>
        <Link to="/">Home</Link>
        <Link to="/about">About</Link>
        <Link to="/menu">Menu</Link>
        <Link to="/contact">Contact</Link>
        <button onClick={toggleTheme}>Toggle</button>
      </div>
      </nav>
  )
}

export default Navbar
