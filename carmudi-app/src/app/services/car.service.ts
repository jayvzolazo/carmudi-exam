import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { catchError, map, tap } from 'rxjs/operators';
import { CarModel } from '../model/CarModel';

const httpOptions = {
  headers: new HttpHeaders({
    'Content-Type': 'application/json'
  })
};

@Injectable({
  providedIn: 'root'
})
export class CarService {
  url = 'http://exam.carmudi.local/api/cars.php';

  constructor(private http: HttpClient) { }

  private handleError<T> (operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {
      console.error(error);
      // this.log(`${operation} failed: ${error.message}`);
      return of(result as T);
    };
  }

  getCars() {
    return this.http.get(`${this.url}`);
  }

  createCar(car: CarModel): Observable<CarModel> {
    return this.http.post<CarModel>(`${this.url}`, JSON.stringify(car), httpOptions)
      .pipe(
        catchError(this.handleError('createCar', car))
      );
  }
}
