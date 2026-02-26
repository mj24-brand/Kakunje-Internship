import React from 'react'
import "./App.css";
import "./App.css"
import styles from "./Btn.module.css";

function Stylecard(){
  function click(){
    alert("Profile Viewed");
  }
  return(
    <div className="profilecard">
      <h2 style={{color:"blue"}}>Name : Jyothika MJ</h2>
      <h3>Role : Intern</h3>
      <h3>Company : Kakunji Software</h3>
      <button onClick={click} className={styles.viewBtn}>View Profile</button>
    </div>
  )
}
export default Stylecard
