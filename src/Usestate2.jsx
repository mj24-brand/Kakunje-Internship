import React from 'react'
import { useState } from 'react'

const Usestate2 = () => {
    const [user,setUser]=useState({
        name:"abc",
        age:"21",
        year:"2026",
        branch:"CSE"
    });

    const updateAge=()=>{
        setUser(prevState=>{
            return{
                ...prevState,
                age:"23"
            }
        })
    }
  return (
    <div style={{padding:"20px"}}>
      <h1>my name is {user.name}</h1>
      <p>and my age is {user.age} year{user.year}</p>
      <button onClick={updateAge}>change age</button>
    </div>
  )
}

export default Usestate2
