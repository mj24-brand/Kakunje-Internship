import React from 'react'
import '../styles/About.css'
import aboutImage1 from "../assets/about1.jpeg";
import aboutImage2 from "../assets/about2.jpeg";
import aboutImage3 from "../assets/about3.jpeg";
const About = () => {
  return (
    <div className='about'>
      <h1>About MJ Cravings</h1><br></br>
      <p>MJ Cravings is created to bring joy to food lovers who enjoy tasty and flavourful snacks.
        Our mission is to provide fresh, high-quality food that satisfies every craving.
        Whether you are looking for something sweet, spicy or crunchy, MJ Craving is here to make your food experience exciting and memorable.
      </p>
      <img src={aboutImage1} alt="aboutImage1"/>
      <img src={aboutImage2} alt="aboutImage2"/>
      <img src={aboutImage3} alt="aboutImage3"/>
    </div>
  )
}

export default About
