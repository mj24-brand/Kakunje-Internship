import React, { useState, useEffect } from "react";
import API, { updateNote, deleteNote } from "../services/api";
import "./Dashboard.css";

const Dashboard = () => {
    const [notes, setNotes] = useState([]);
    const [text, setText] = useState("");
    const [editId, setEditId] = useState(null);

    // Fetch notes
    const fetchNotes = async () => {
        try {
            const res = await API.get("/notes");
            setNotes(res.data);
        } catch (err) {
            console.error(err);
        }
    };

    // IMPORTANT: Load notes on page load
    useEffect(() => {
        fetchNotes();
    }, []);

    // Add / Update note
    const addNote = async () => {
        try {
            if (editId) {
                await updateNote(editId, { text });
                setEditId(null);
            } else {
                await API.post("/notes", { text });
            }

            setText("");
            fetchNotes();
        } catch (err) {
            console.error(err);
        }
    };

    // Delete note
    const handleDelete = async (id) => {
        try {
            await deleteNote(id);
            fetchNotes();
        } catch (err) {
            console.error(err);
        }
    };

    // Logout
    const logout = () => {
        localStorage.removeItem("token");
        window.location.href = "/";
    };

    return (
        <div className="container1">
            <h2>DASHBOARD</h2>

            <div className="input-section">

            <input
                value={text}
                onChange={(e) => setText(e.target.value)}
                placeholder="Enter note"
            />

            <button className="add-btn"
            onClick={addNote}>
                {editId ? "Update" : "Add"}
            </button>

            <button className="logout-btn"
            onClick={logout}>Logout</button>
            </div>

            <ul>
                {notes.length > 0 ? (
                    notes.map((n) => (
                        <li key={n._id}>
                            {n.text}

                            <div className="note-actions">
                            <button className="edit-btn"
                                onClick={() => {
                                    setText(n.text);
                                    setEditId(n._id);
                                }}
                            >
                                Edit
                            </button>

                            <button className="delete-btn"
                            onClick={() => handleDelete(n._id)}>
                                Delete
                            </button>
                            </div>
                        </li>
                    ))
                ) : (
                    <p>No notes found</p>
                )}
            </ul>
        </div>
    );
};

export default Dashboard;