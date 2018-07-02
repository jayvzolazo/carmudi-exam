import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-cars-list',
  templateUrl: './cars-list.component.html',
  styleUrls: ['./cars-list.component.scss']
})
export class CarsListComponent implements OnInit {
  @Input() carsList: Array<object> = [];

  // objectList: Array<object> = [];

  constructor() { }

  // private buildObjects(): void {
  //   let objectList = this.carsList;
  // }

  ngOnInit() {
    // this.buildObjects();
  }

}
