import React, { useEffect } from 'react'

const UseeffectTask = () => {
    useEffect(()=>{
        alert("Welcome to React Hooks");
        console.log("Component Mounted");
    },[])
  return (
    <div>
      <h2>Welcome to React Hooks</h2>
    </div>
  )
}

export default UseeffectTask
