<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Roles
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Usuarios del sistema</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Usuario </li>
  	</template>
</Breadcrumbs>

	<div class="card mb-3">
		<div class="card-header d-flex">
			<span>
				<i class="fas fa-chart-area"></i>
					Administrar Estadistica de Atencion
			</span>
		<button class="btn btn-primary btn-sm ml-auto" @click="pruebita()"  ><span class="fa fa-plus"></span> Nuevo</button>
		 
		</div>
	</div>
		<div class="row">
			<div class="col-md-12  ml-auto mr-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">

							<div class="col-md-12 ">
								<b-card border-variant="success" align="center">
						        <h2>Estadisticas de Atencion</h2>
						      </b-card>
							</div >	


			<div class="col-md-6">
				<b-card border-variant="success" header="Dia" align="center">
		        <canvas ref="chart"></canvas>
		      </b-card>
			</div >	
			<div class="col-md-6">
				<b-card border-variant="success" header="Success" align="center">
		        <canvas ref="chart2"></canvas>
		      </b-card>
			</div >	
			<div class="col-md-6">
				<b-card border-variant="success" header="Success" align="center">
		        <canvas ref="chart3"></canvas>
		      </b-card>
			</div >	
			<div class="col-md-6">
				<b-card border-variant="success" header="Success" align="center">
		        <canvas ref="chart4"></canvas>
		      </b-card>
			</div >	
			<div class="col-md-6">
				<b-card border-variant="success" header="Success" align="center">
		        <canvas ref="chart11"></canvas>
		      </b-card>
			</div >	
			<div class="col-md-6">
				<b-card border-variant="success" header="Success" align="center">
		        <canvas ref="chart11"></canvas>
		      </b-card>
			</div >				
      

      

							
							
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Chart with HTML Legends</div>
									</div>
									<div class="card-body">
										<div class="card-sub">
											Sometimes you need a very complex legend. In these cases, it makes sense to generate an HTML legend. Charts provide a generateLegend() method on their prototype that returns an HTML string for the legend.
										</div>
										<canvas ref="chart3"></canvas>
										<div class="chart-container">
											<canvas id="htmlLegendsChart"></canvas>
										</div>
										<div id="myChartLegend"></div>
									</div>
								</div>
							</div>
						</div>

						

					</div>
				</div>
			</div>
		</div>
	

</base-layout>

</template>
<script>

import Breadcrumbs from '../../../components/layouts/back/includes/Breadcrumbs.vue';
import * as categoryService from '../../../services/category_service';

export default{
	components: {
		Breadcrumbs,
		
		
	},



	data(){
		return {
			data : {
				
			},
			//pruebita:false
			
		}
	},


	methods : {
		
		pruebita(){

			axios.get('app/estadisticaAtencion').then((response) => {
				//console.log('mont',esponse.data.month)

				//this.resxd=response.data.us[4]
				this.resxd=response.data.us[1]

				console.log('los datos de US ',this.resxd)
				console.log('los datos de ',response.data.puedeser)





				//this.resxd = response.data
        	var chart = this.$refs.chart;
        	var chart2 = this.$refs.chart2;
        	var chart3 = this.$refs.chart3;
        	var chart4 = this.$refs.chart4;
            var ctx = chart.getContext("2d");
            var ctx2 = chart2.getContext("2d");
            var ctx3 = chart3.getContext("2d");
            var ctx4 = chart4.getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    //labels: response.data.datac,
                    //labels: response.data.dias,
                    //labels: ['prueba','prueba 2'],
                    labels: response.data.fechaf,
                    datasets: [/*{
                    	//backgroundColor :["#1d7af3","#f3545d","#fdaf4b","#f3000d","#ddaf4b"],
						//borderWidth: 0,

                    	borderWidth: 1,
			            borderColor: [
				            'rgba(255,99,132,1)',
				            'rgba(54, 162, 235, 1)',
				            'rgba(255, 206, 86, 1)',
				            'rgba(75, 192, 192, 1)',                
				            'rgba(153, 102, 255, 1)',                 
			            ],
			            backgroundColor: [
				            'rgba(255, 99, 132, 0.3)',
				            'rgba(54, 162, 235, 0.3)',
				            'rgba(255, 206, 86, 0.3)',
				            'rgba(75, 192, 192, 0.3)',
				            'rgba(153, 102, 255, 0.3)',                
			            ],
			           // pointBorderColor: '#2554FF',

                        //label: '# of Votes',

                        data: response.data.data,
                        label: response.data.month,
                        //label: ['1','2'],
                          
                    },*/
                    response.data.puedeser,

                    ],

                },
                options: {
                	responsive: true, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
				                display: true
				              }
                        }],
                        xAxes: [{
			              gridLines: {
			                display: false
			              }
			            }]


                    },
                    legend: {
			            position : 'bottom',
						labels : {
							fontColor: 'rgb(154, 154, 154)',
							fontSize: 11,
							usePointStyle : true,
							padding: 10
						}
			          },

				
					
				layout: {
					padding: {
						left: 0.1,
						right: 0.1,
						top: 0.1,
						bottom: 0.1
					}
				},

			          
          
                }
            });
            var myPieChart = new Chart(ctx2, {
           
                type: 'pie',
                data: {
                    //labels: response.data.month,
                    labels: response.data.datac,
                    datasets: [{
                    	//backgroundColor :["#1d7af3","#f3545d","#fdaf4b","#f3000d","#ddaf4b"],
						//borderWidth: 0,

                    	borderWidth: 1,
			            borderColor: [
				            'rgba(255,99,132,1)',
				            'rgba(54, 162, 235, 1)',
				            'rgba(255, 206, 86, 1)',
				            'rgba(75, 192, 192, 1)',                
				            'rgba(153, 102, 255, 1)',                 
			            ],
			            backgroundColor: [
				            'rgba(255, 99, 132, 0.3)',
				            'rgba(54, 162, 235, 0.3)',
				            'rgba(255, 206, 86, 0.3)',
				            'rgba(75, 192, 192, 0.3)',
				            'rgba(153, 102, 255, 0.3)',                
			            ],
			           // pointBorderColor: '#2554FF',

                        //label: '# of Votes',
                        label: response.data.datac,
                        data: response.data.data,
                        
                    }]
                },
                options: {
                	responsive: true, 
                   /* scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
				                display: true
				              }
                        }],
                        xAxes: [{
			              gridLines: {
			                display: false
			              }
			            }]


                    },*/
                    legend: {
			            position : 'bottom',
						labels : {
							fontColor: 'rgb(154, 154, 154)',
							fontSize: 11,
							usePointStyle : true,
							padding: 20
						}
			          },

				pieceLabel: {
					render: 'percentage',
					fontColor: 'white',
					fontSize: 24,
				},
					//tooltips: false,
				layout: {
					padding: {
						left: 0.1,
						right: 0.1,
						top: 0.1,
						bottom: 0.1
					}
				},

			          
          
                }
            });
         var myChart = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: response.data.fechaf,
                    datasets: [{
                    	
                    	backgroundColor :["#1d7af3","#f3545d","#fdaf4b","#f3000d","#ddaf4b"],
						//borderWidth: 0,

                    	borderWidth: 1,
			            borderColor: [
				            'rgba(255,99,132,1)',
				            'rgba(54, 162, 235, 1)',
				            'rgba(255, 206, 86, 1)',
				            'rgba(75, 192, 192, 1)',                
				            'rgba(153, 102, 255, 1)',                 
			            ],
			          /*  backgroundColor: [
				            'rgba(255, 99, 132, 0.3)',
				            'rgba(54, 162, 235, 0.3)',
				            'rgba(255, 206, 86, 0.3)',
				            'rgba(75, 192, 192, 0.3)',
				            'rgba(153, 102, 255, 0.3)',                
			            ],*/
			           // pointBorderColor: '#2554FF',

                        //label: '# of Votes',
                        label: response.data.usuariof,
                        data: response.data.cantidadf,


                        
                    }]
                },
                options: {
                	responsive: true, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
				                display: true
				              }
                        }],
                        xAxes: [{
			              gridLines: {
			                display: false
			              }
			            }]


                    },
                    legend: {
			            position : 'bottom',
						labels : {
							fontColor: 'rgb(154, 154, 154)',
							fontSize: 11,
							usePointStyle : true,
							padding: 10
						}
			          },

				
					
				layout: {
					padding: {
						left: 0.1,
						right: 0.1,
						top: 0.1,
						bottom: 0.1
					}
				},

			          
          
                }
            });

 var myChart = new Chart(ctx4, {
                type: 'bar',

                data: {
                	//backgroundColor :["#1d7af3","#f3545d","#fdaf4b","#f3000d","#ddaf4b"],
				//labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],

				labels: response.data.fechaf,
				//datasets:response.data.unio,


					
				datasets : [{
					
					label: response.data.usuariof,
					//label: ['1','2'],
					
     
					//data: response.data.unio,
					data: this.resxd,
					

				}],

				/*datasets : [{
					
					//label: "First time visitors",
					//label: ['1','2','3'],
					label: response.data.usuariof,
					//backgroundColor: '#59d05d',
					backgroundColor :['rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'],
					 borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
					//data: [{x:'2021-03-24', y:20}, {x:'2021-04-20', y:10}, {x:'2021-04-09', y:9}]
					data: response.data.unio,
					//data: [['x':'2021-03-24', 'y':20], {'x':'2021-04-20', 'y':10], ['x':'2021-04-09', 'y':9]]

				}],*/
			},

                options: {

                	// events: ['mousemove', 'mouseout', 'click', 'touchstart', 'touchmove'],
                	responsive: true, 
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
				                display: true
				              }
                        }],
                        xAxes: [{
			              gridLines: {
			                display: false
			              }
			            }]


                    },
                    legend: {
			            position : 'bottom',
						labels : {
							fontColor: 'rgb(154, 154, 154)',
							fontSize: 11,
							usePointStyle : true,
							padding: 10
						}
			          },

				
					
				layout: {
					padding: {
						left: 0.1,
						right: 0.1,
						top: 0.1,
						bottom: 0.1
					}
				},

			          
          
                }
            });




        }).catch(error => {
        console.log(error)
        this.errored = true
      });
		}



	},

			/*	const [res, resa] = await Promise.all([
					this.callApi('get', 'app/atencion'),
					this.callApi('get', 'app/tipoatencion')
				])*/

	 mounted() {
      //  let uri = 'http://localhost:8000/estadisticaAtencion';
        //this.pruebita();
     },




}






  </script>