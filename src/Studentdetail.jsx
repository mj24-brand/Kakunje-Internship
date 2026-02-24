import React from 'react'

function Studentdetail(){
    const StudentName="Abc";
    const Course="MCA";
    const Year=2026;
    return(
        <div>
            <h1>STUDENT DETAILS</h1>
        <h2>Student Name: <span style={{color:"green"}}>{StudentName}</span></h2>
        <h3>Course: {Course}</h3>
        <h3>Year: {Year}</h3>
        </div>
    )
}

export default Studentdetail
