import React from 'react'

function Click(){
    function handleClick(){
        alert("button clicked")
    }
    return <button onClick={handleClick}>Click here</button>
}

export default Click
