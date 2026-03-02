import React from 'react'
import { useEffect } from 'react';
import "../styles/Home.css"

function Home() {
    useEffect(()=>{
        console.log("Hello")

    },[]);
  return (
    <div className='home'>
        <h1>Welcome to Student Portal</h1>
        <p>This is a Student Portal where you ca share your responses and clarify your doubts. Stay updated!!</p>
        <p>Share your feedback with us....</p>

    </div>
  )
}

export default Home