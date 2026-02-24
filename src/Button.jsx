import React from 'react'

function Button(){
    function Click(){
        console.log("Submitted Successfully");
        alert("Form Submitted");
    }
    return(
        <div>
        <h1>Button with Console</h1>
        <button onClick={Click}>Submit</button>
        </div>
    )
}

export default Button
