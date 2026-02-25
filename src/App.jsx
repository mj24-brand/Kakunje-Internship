import React from 'react'
import WelcomeFunc from './WelcomeFunc'
import WelcomeClass from './WelcomeFunc1'
import Student from './Student'
import Parent from './Parent'

const App = () => {
  return (
    <div>
      <WelcomeFunc name ="Jyothika"/>
      <WelcomeClass name= "MJ"/>
      <Student name="Alice" marks={48}/>
       <Student name="Bob" marks={38}/>
      <Parent/>
    </div>
  )
}

export default App
