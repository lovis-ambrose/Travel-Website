import React, { useState, useEffect } from "react";
import beach from "../../assets/beach.jpg";
import islandd from "../../assets/islandd.jpg";
import thailand from "../../assets/thailand.jpeg";
import "./Hero.css";

const Hero = () => {
  const [currentIndex, setCurrentIndex] = useState(0);

  const backgrounds = [
    { image: `url(${beach})`, text: "TRAVEL TO EXPLORE", p: "Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit, Sed Do Eiusmod Tempor Incididunt Ut Labore Et Dolore Magna Aliqua. Ultricies Mi Eget" },
    { image: `url(${islandd})`, text: "TRAVEL TO EXPLORE", p: "Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit, Sed Do Eiusmod Tempor Incididunt Ut Labore Et Dolore Magna Aliqua. Ultricies Mi Eget" },
    { image: `url(${thailand})`, text: "TRAVEL TO EXPLORE", p: "Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit, Sed Do Eiusmod Tempor Incididunt Ut Labore Et Dolore Magna Aliqua. Ultricies Mi Eget" },
  ];

  useEffect(() => {
    const timer = setInterval(() => {
      setCurrentIndex((prevIndex) => (prevIndex + 1) % backgrounds.length);
    }, 5000);

    return () => clearInterval(timer);
  }, []);

  return (
    <section className="hero_section">
      <div
        className="hero"
        style={{ backgroundImage: backgrounds[currentIndex].image }}>
        <div className="hero-content">
          <h1 className="multiline-text">{backgrounds[currentIndex].text}</h1>
          <p className="multiline-text">{backgrounds[currentIndex].p}</p>
        </div>
      </div>
    </section>
  );
};

export default Hero;
