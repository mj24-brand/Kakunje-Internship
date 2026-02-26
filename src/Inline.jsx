import React from 'react'

const Inline = () => {

  const headingStyle={
    color:"pink",
    backgroundColor:"lightBlue",
    fontSize:"40px",
    padding:"10px"
  };
  return (
    <>
   <h2 style={{color:"red",fontSize:"30px"}}>Some text</h2>

   <h5 style={headingStyle}>inline style</h5>
   </>
  )
}

export default Inline
