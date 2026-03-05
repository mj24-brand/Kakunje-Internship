import React, { useEffect, useRef, useState } from "react";
import "../styles/Contact.css";

const Contact = () => {

  const [name, setName] = useState("");
  const [message, setMessage] = useState("");
  const [submitted, setSubmitted] = useState(false);
  const inputRef = useRef(null);

  useEffect(() => {
    inputRef.current.focus();
  }, []);

  const handleSubmit = (e) => {
    e.preventDefault();
    setSubmitted(true);
  };

  return (
    <div className="contact">

      <h1 className="contact-title">
        <i className="bi bi-telephone-fill"></i> Contact Us
      </h1>

      <p className="contact-desc">
        Have a question or craving something delicious? Get in touch with
        MJ Cravings! We’re always happy to hear from our customers and help
        you enjoy the best food experience.
      </p>

      <div className="row">

        <div className="col-md-5">

          <div className="feedback">
            <h2>Feedback Form</h2>

            {!submitted ? (
              <form onSubmit={handleSubmit}>

                <input
                  type="text"
                  ref={inputRef}
                  className="form-control mb-2"
                  placeholder="Enter your name"
                  value={name}
                  onChange={(e) => setName(e.target.value)}
                />

                <textarea
                  className="form-control mb-2"
                  rows="4"
                  placeholder="Enter your feedback"
                  value={message}
                  onChange={(e) => setMessage(e.target.value)}
                ></textarea>

                <p>Characters: {message.length}</p>

                <button type="submit" className="btn btn-dark">
                  Submit
                </button>

              </form>
            ) : (
              <h4>Thank you {name} for your feedback!</h4>
            )}

          </div>

        </div>
        <div className="col-md-3">

          <i className="bi bi-geo-alt-fill"></i>
          <p>Address: Madikeri - 571201, Kodagu</p>

          <i className="bi bi-phone"></i>
          <p>Phone no: 6699875546</p>

          <i className="bi bi-envelope"></i>
          <p>Email: jyo213@gmail.com</p>

        </div>

        <div className="col-md-4">
          <iframe
            src="https://www.google.com/maps?q=Madikeri&output=embed"
            width="100%"
            height="250"
            style={{ border: 0 }}
            loading="lazy"
            title="map"
          ></iframe>

        </div>

      </div>

    </div>
  );
};

export default Contact;