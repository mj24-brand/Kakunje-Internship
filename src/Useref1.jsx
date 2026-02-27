import React,{ useRef} from 'react'

const Useref1 = () => {
    const inputElement=useRef();

    const focusInput=()=>{
        inputElement.current.focus()
    }
  return (
    <div>
      <input type='text' ref={inputElement}/>
      <button onClick={focusInput}>focus Input</button>
    </div>
  )
}

export default Useref1
