import React from 'react'

const ClickExample = () => {

  function handleClick(){
    alert("button clicked")
  }
  return (
    <div>
       <button onClick={handleClick}>Click</button>
    </div>
  )
}


export default ClickExample
