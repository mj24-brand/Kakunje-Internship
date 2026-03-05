import React from 'react'
import "../styles/Home.css"
import homeImage from "../assets/homepg1.jpeg";
import homeImage1 from "../assets/mjlogo.webp";
const Home = () => {
  return (
    <div className='home'>
      <h1>Welcome to MJ Cravings</h1>
      <img src={homeImage1} alt="homeImage1" style={{width:"15%",height:"100px"}}/>
      <h2>"Satisfy Your Cravings, One Bite at a Time..!"</h2>
      <p>This is the perfect place for food lovers who enjoy delicious and
        satisfying treats. We bring you a variety of tasty snacks and 
        flavours that make every moment special. Fresh ingredients, great taste, and unforgettable cravings-all in one place.
      </p>
      <img src={homeImage} alt="homeImage" style={{width:"900px",height:"500px"}}/>
      </div>
  )
}

export default Home
