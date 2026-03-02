import React from 'react'
import { Link } from 'react-router-dom'
import { useContext } from 'react'
import { ThemeContext} from '../context/ThemeContext'
import "../styles/Navbar.css"

function Navbar() {
    const {toggleTheme}=useContext(ThemeContext)
  return (
    <div>
        <nav className='navbar'>
            <h2>STUDENT PORTAL</h2>
            <div>
                 <Link to="/login">Login</Link>
                <Link to="/">Home</Link>
                <Link to="/about">About</Link>
                <Link to="/feedback">Feedback</Link>
               
                <button onClick={toggleTheme}>Toggle theme </button>
            </div>

        </nav>
    </div>
  )
}

export default Navbar