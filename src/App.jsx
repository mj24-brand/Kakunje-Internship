import React from 'react'
import Stylecard from './Stylecard'
import Liveinput from './Liveinput'
import Form from './Form'
import  "./Form.css"
import Feedback from './Feedback'
import  './Feedbackbtn.module.css'



const App = () => {
  return (
    <div>
      <Stylecard className='profilecard'/>
      <Liveinput/>
      <Form/>
      <Feedback/>
    </div>
  )
}

export default App

