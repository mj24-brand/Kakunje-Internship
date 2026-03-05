import {createContext, useState } from 'react'
import React from 'react';
import "../styles/Navbar.css"

 export const ThemeContext = createContext();
 export const ThemeProvider=({children})=>{
    const [theme,setTheme]=useState("light");

    const toggleTheme=()=>{
        setTheme(theme=="light"?"dark":"light");
    }

 
  return (
    <div className={theme}>
      <ThemeContext.Provider value={{theme,toggleTheme}}>
        {children}
      </ThemeContext.Provider>
    </div>
  )
}

export default ThemeContext;
