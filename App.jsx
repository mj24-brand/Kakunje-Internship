import React from 'react'
import New from './New';
import Inline from './Inline';
import Click from './Click';
import Welcome from './Class';
import Counter from './Counter';
import Counter1 from './Counter1';
import Greet from './Greet';
import Greet1 from './Greet1';
import UserCard from './UserCard';
import Child from './Child';
import Login from './Login';
import Role from './Role';
import Ternary from './Ternary';
import Dashboard from './Dashboard';



function App(){
//const name="Jyothika";
const showMessage =()=>{
  alert("hello from parent component");
};

return(
  <div>
    {/*<New/>
    <h1>hello {name}</h1>
    <p>hello world</p>
    <Inline/>
    <Click/>

    <Welcome/>
    <Counter/>
    <Counter1/>*/}

    <Greet name="abc"/>
    <Greet1 name="xyz"/>
    <UserCard name="abcdef" age={21} city="madikeri"/>
    <UserCard name="qwerty" age={22} city="mumbai"/>
    <Child message={showMessage}/>
    <Login/>
    <Role/>
    <Ternary/>
    <Dashboard/>
  </div>
);
}
export default App;
