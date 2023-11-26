import React from "react";
import "./Services.css";
import { servicesdata } from "../../data/servicesdata";



const Services = () => {

  let array_data = [];

    // var xmlhttp=new XMLHttpRequest();
    // xmlhttp.onreadystatechange=function() {
    //   if (this.readyState==4 && this.status==200) {
    //     let x = JSON.parse(this.responseText);
    //       x.forEach(element => {
    //       data.push(element);
    //       });
    //      console.log(data);
          
    //   }
    // }
    // xmlhttp.open("GET","http://localhost/CRUD/fetchTravelData.php",true);
    // xmlhttp.send();

    async function showData() {
     let res =  await fetch("http://localhost/CRUD/fetchTravelData.php");
     let data = await res.json();  
     console.log(data)
        return data;
    }
    
 showData().then((x) => {
array_data = [...array_data, x];
 
  console.log(`Data ${x.name}`);
  return (
    <section className="services" id="about">
      {array_data.map((service, index) => (
        <div key={index} className="servicess_card">
          {/* {service.icon} */}
          <h3>{service.name}</h3>
          <p>{service.description}</p>
        </div>
      ))}
    </section>
  );
}) 
};

export default Services;
