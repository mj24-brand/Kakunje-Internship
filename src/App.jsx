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
import ClickExample from './ClickExample';
import ChangeEvent from './ChangeEvent';
import Submit from './Submit';
import Focus from './Focus';
import Parameter from './Parameter';
import BasicList from './BasicList';
import UserList from './UserList';
import Table from './Table';
import Form1 from './Form1';
import Form2 from './Form2';
import { BrowserRouter,Routes,Route,Link } from 'react-router-dom';
import Home from './Home';
import About from './About';
import Parent from './Parent';
import "./App.css"
import styles from "./App.module.css"
import Hooks1 from './Hooks1';
import Usestate2 from './Usestate2';
import Useeffect1 from './Useeffect1';
import Useeffect2 from './Useeffect2';
import Useeffect3 from './Useeffect3';
import UserContext from './UserContext';
import ChildComponent from './ChildComponent';
import Useref from './Useref';
import Useref1 from './Useref1';
import Counter5 from './Counter5';
import Countertask from './Countertask';
import UseeffectTask from './UseeffectTask';
import Messagetask from './Messagetask';




function App(){
//const name="Jyothika";
//const showMessage =()=>{
  //alert("hello from parent component");
//};

return(
  <div>

    {/* <BrowserRouter>
    <Link to="/">Home</Link>
    <Link to="/about">About</Link>

    <Routes>
      <Route path="/" element={<Home/>}/>
      <Route path="/about" element={<About/>}/>
    </Routes>

    </BrowserRouter>
   <New/>
    <h1>hello {name}</h1>
    <p>hello world</p>
    <Inline/>
    <Click/>

    <Welcome/>
    <Counter/>
    <Counter1/>*/}

    {/*<Greet name="abc"/>
    <Greet1 name="xyz"/>
    <UserCard name="abcdef" age={21} city="madikeri"/>
    <UserCard name="qwerty" age={22} city="mumbai"/>
    <Child message={showMessage}/>
    <Login/>
    <Role/>
    <Ternary/>
    <Dashboard/> 
    <ClickExample/>
    <ChangeEvent/>
    <Submit/>
    <Focus/>
    <Parameter/>
    <BasicList/>
    <UserList/>
    <Table/>
    <Form1/>
    <Form2/>
    <Parent/>
    <Inline/>

    <h1 className='heading'>External CSS styling</h1>
    <p className='p1'>some paragraph</p>

    <h4 className={styles.h4}>heading 4 using css module</h4>
    <Hooks1/>
    <Usestate2/>
    <Useeffect1/>
    <Useeffect2/>
    <Useeffect3/>
    <UserContext.Provider value="abc">
      <ChildComponent/>
    </UserContext.Provider>
    <Useref/>
    <Useref1/>
    <Counter5/>*/}
    <Countertask/>
    <UseeffectTask/>
    <Messagetask/>
  </div>
);
}
export default App;
