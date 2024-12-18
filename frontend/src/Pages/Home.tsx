import React from "react";
import { Link } from "react-router-dom";

const Home = () => {
  return (
    <div className="container mx-auto mt-5">
      <h1 className="text-3xl font-bold text-center">Home</h1>
      <p className="text-center mt-5">
        <Link to="/about" className="text-blue-500">
          Go to About
        </Link>
      </p>
    </div>
  );
};

export default Home;
