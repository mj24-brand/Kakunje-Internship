import React, { useContext, useEffect, useRef, useState } from "react";
import { ThemeContext } from "../context/ThemeContext";
import "../styles/Login.css";

const Login = () => {
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [submitted, setSubmitted] = useState(false);

    const inputRef = useRef(null);
    const { theme } = useContext(ThemeContext);

    useEffect(() => {
        inputRef.current.focus();
    }, []);

    const handleSubmit = (e) => {
        e.preventDefault();

        setSubmitted(true);
    };

    return (
        <div className={`login ${theme}`}>
            <h2>Login Form</h2>

            {!submitted ? (
                <form onSubmit={handleSubmit}>
                    <input
                        type="text"
                        ref={inputRef}
                        placeholder="Enter your name"
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                    />

                    <input
                        type="email"
                        placeholder="Enter your email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                    />

                    <input
                        type="password"
                        placeholder="Enter your password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />

                    <button type="submit">Log In</button>

                    <button type="button" className="link-btn">
                        Forgot Password?
                    </button>

                    <button type="button" className="link-btn">
                        Create New Account
                    </button>

                    <h5>Or Login with:</h5>
                    <button type="button" className="link-btn1">
                        <i className="bi bi-google"></i> Sign in with Google
                    </button>

                    <button type="button" className="link-btn2">
                        <i className="bi bi-facebook"></i> Sign in with Facebook
                    </button>

                </form>
            ) : (
                <h3>Welcome {name}! You have successfully logged in.</h3>
            )}
        </div>
    );
};

export default Login;