import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { AuthProvider } from './context/AuthContext'; // или где у тебя этот файл

import './App.css';
import Navbar from './components/Navbar';
import CreatePost from './components/CreatePost';
import Post from './components/Post';
import PostList from './components/PostList';
import ProtectedRoute from './components/ProtectedRoute';
import Register from './components/Register';
import Login from './components/Login';


function App() {
  return (
    <AuthProvider>
      <Router>
        <Navbar />   {/* ✅ Always visible */}
        <Routes>
          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Register />} />

          <Route
            path="/"
            element={
              <ProtectedRoute>
                <PostList />
              </ProtectedRoute>
            }
          />
          <Route
            path="/post/:id"
            element={
              <ProtectedRoute>
                <Post />
              </ProtectedRoute>
            }
          />
          <Route
            path="/create"
            element={
              <ProtectedRoute>
                <CreatePost />
              </ProtectedRoute>
            }
          />
        </Routes>
      </Router>
    </AuthProvider>
  );
}

export default App;