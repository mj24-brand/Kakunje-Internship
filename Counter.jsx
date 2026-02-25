import React, {Component} from "react";

class Counter extends React.Component{
    constructor(){
        super();
        this.state={count :0};
    }
    increase=()=>{
        this.setState({count:this.state.count+1});
    };
    render(){
        return(
            <>
            <h1>{this.state.count}</h1>
            <button onClick={this.increase}>Increase</button>
            </>
        )
    }
}
export default Counter;