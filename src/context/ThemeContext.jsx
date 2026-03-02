import { createContext,useState } from "react";
import React from 'react'
import "../styles/Navbar.css"
export const ThemeContext = createContext();
    function ThemeProvider({children}){
        const [theme, setTheme]=useState("light");

        const toggleTheme=()=>{
            setTheme(theme==="light"?"dark":"light");
        }
  return (
    <>
    <ThemeContext.Provider value={{theme, toggleTheme}}>
        {children}
    </ThemeContext.Provider>
    </>
  )
}


export default ThemeProvider;