import React, { useState } from 'react'
import Admin from './Admin';
import User from './User';

const Dashboard = () => {
    const [role,setRole]=useState("user");
  return (
    <div>
      {role==="admin"?<Admin/>:<User/>}

      <button onClick={()=>setRole("admin")}>Admin dashboard</button>
      <button onClick={()=>setRole("user")}>User dashboard</button>
    </div>
  )
}

export default Dashboard;
