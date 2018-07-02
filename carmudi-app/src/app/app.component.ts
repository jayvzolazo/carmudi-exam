import { Component, OnInit } from '@angular/core';
import { CarService } from './services/car.service'
import { Car } from './interface/Car';
import { CarModel } from './model/CarModel';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  cars: Car[];

  constructor(private carService: CarService) {}

  car: CarModel = {
    name: '',
    engineDisp: 0,
    enginePower: 0,
    price: 0,
    location: ''
  };

  private getCars() : void {
    this.carService.getCars().subscribe((data: Car[]) => {
      this.cars = data;
    });
  }

  submitCar() {
    this.carService.createCar(this.car).subscribe(res => {
      // update the list view
      this.getCars();
      // reset the car model to clear the form
      this.car = {
        name: '',
        engineDisp: 0,
        enginePower: 0,
        price: 0,
        location: ''
      };
    });
  }

  ngOnInit() {
    this.getCars();
  }
}
